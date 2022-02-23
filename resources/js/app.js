require('./bootstrap');

import { defaultsDeep } from 'lodash';
import Vue from 'vue'

new Vue({
    el: '#app',
    data: {
        id: document.getElementById('from_id').value,
        search: document.getElementById('to_id').value,
        messages: [],
        users: [],
        form: {
            to_id: parseInt(document.getElementById('to_id').value),
            content: '',
            job_type:document.getElementById('job_type').value,
            job_id:document.getElementById('job_id').value,
        },
        isActive: null,
        notif: 0,
        type:4,
        allowedExtensions:['pdf','jpg','jpeg','png','zip']
    },
    mounted() {
        this.fetchUsers()
    },
    created() {
        this.fetchPusher()
    },
    methods: {
        fetchUsers() {
            let q = _.isEmpty(this.search) ? 'all' : this.search
            q = this.search;
            axios.get('/message/user/' + q).then(({ data }) => {
                this.users = data
                console.log(this.users)
                this.fetchMessages()
            })
        },
        fetchMessages() {
            let to_id = this.form.to_id
            axios.get('/message/user-message/' + to_id).then(({ data }) => {
                this.messages = data
                this.isActive = this.users.findIndex((s) => s.id === to_id)
                this.users[this.isActive].count = 0
                this.notif--
            })
        },
        sendMessage() {
            let files = $("#file").prop("files");
            if(files.length > 0) {
                this.saveFile()
            }
            else{
                this.sendOnlyMessage()
            }
        },
        sendOnlyMessage(response) {
            let formdata = this.form
            if(response != undefined){
                formdata.filepath = response.filepath
                formdata.filename = response.filename
            }
            axios.post('/message/user-message', formdata).then(({ data }) => {
                this.pushMessage(data, data.to_id)
                this.form.content = ''
                //this.search = ''
            })
        },
        fetchPusher() {
            Echo.channel('user-message.' + this.id)
                .listen('MessageEvent', (e) => {
                    console.log("this is test")
                    this.fetchUsers()
                    this.pushMessage(e, e.from_id, 'push')
                })
        },
        pushMessage(data, user_id, action = '') {
            let index = this.users.findIndex((s) => s.id === user_id)

            if (index != -1 && action == 'push') {
                console.log("sdfsf");
                this.users.splice(index, 1)
            }

            /**
             * if untuk pesan submit
             */
            if (action == '') {
                this.users[index].content = data.content
                this.users[index].to_id = data.to_id

                let user = this.users[index]

                this.users.splice(index, 1)
                this.users.unshift(user)
            }

            /**
             * else untuk pesan dari laravel echo
             */
            else {
                this.users.unshift(data)
            }

            /**
             * Jika dia melihat pesan user
             */
            if (this.form.to_id != '') {
                index = this.users.findIndex((s) => s.id === this.form.to_id)

                this.users[index].count = 0
                this.isActive = index

                if (this.form.to_id == user_id) {

                    this.messages.push({
                        avatar: data.avatar,
                        content: data.content,
                        filename: data.filename,
                        filepath: data.filepath,
                        created_at: data.created_at,
                        from_id: data.from_id,
                    })

                    axios.get('/message/user-message/' + user_id + '/read')

                }

            }
        },
        scrollToEnd: function () {
            let container = this.$el.querySelector("#card-message-scroll");
            container.scrollTop = container.scrollHeight;
        },
        /**
         * show error messages
         * @param  {string} title
         * @param  {string} message
         * @return {void}
         */
        showError(title,message) {
            // swal({
            //     title: title,
            //     text: message,
            //     type: "error",
            //     confirmButtonText: "Ok"
            // });
            alert(message);
        },
        /**
         * find extension of uploaded file
         * @param  {string} filename
         * @return {string}
         */
        findExtension(filename) {
            return filename.split('.').pop().toLowerCase()
        },
        /**
         * to validate file size
         * @param  {integer} filesize
         * @return {boolean}
         */
        validateSize(filesize) {
            // 2*1024*1024 = 2097152 = 2mb
            if(filesize > 2097152) {
                this.title = "File size limit exceed!";
                this.message = "Please upload file less than 2MB.";
                this.showError(this.title,this.message);
                return false;
            }
            return true;
        },
        /**
         * to validate file extension
         * @param  {string} extension
         * @return {bolean}
         */
        validateExtension(extension) {
            if($.inArray(extension, this.allowedExtensions) !== -1) {
                return true
            } else {
                this.title = "Invalid file!";
                this.message = "Please upload jpg,png,pdf or zip file only.";
                this.showError(this.title,this.message);
                return false
            }
        },
        /**
         * validate file
         * @param  {integer} filesize
         * @param  {string} extension
         * @return {boolean}
         */
        validateFile(filesize,extension) {
            if(this.validateSize(filesize) && this.validateExtension(extension)) {
                return true
            } else {
                return false
            }

        },
        chooseFile() {
            $("#file").click();
        },
        onFlieChange(file) {
            let files = $("#file").prop("files");
            if(files.length > 0) {
                let file = files[0];
                let filename = file.name;
                $("#file_name").text(filename);
            }
        },
        saveFile() {
            console.log("savefile start")
            let files = $("#file").prop("files")
            let formData = new FormData()
            let file = files[0]
            let filename = file.name
            let filesize = file.size
            let extension = this.findExtension(filename)
            if(extension == 'pdf') {
                this.type = 2
            } else if(extension == 'zip') {
                this.type = 3
            }

            // if uploaded file is valid with validation rules
            if(this.validateFile(filesize,extension)) {
                console.log("filesize start")
                formData.append('file',files[0])
                formData.append('type',this.type)
                axios.post('/message/fileupload',formData).then(({ data }) => {
                    console.log(data)
                    if(data.success){
                        this.sendOnlyMessage(data);
                        $("#file_name").text("");
                    }
                    else
                        alert("error");
                });
            }
        }
    },
    watch: {
        search: _.debounce( function() {
            this.fetchUsers()
        }, 500),
        users: _.debounce( function() {
            this.notif = 0
            this.users.filter(e => {
                if (e.count) {
                    this.notif++
                }
            })
        }),
        messages: _.debounce( function() {
            this.scrollToEnd()
        }, 10),
    }
})
