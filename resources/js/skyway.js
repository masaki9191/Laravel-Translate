
/* eslint-disable require-jsdoc */
$(document).ready(function() {
    // Peer object
    const Peer = require('skyway-js');
    const peer = new Peer({
        key:   "479d37ce-b49e-4417-b855-59d1b68c5dda",
        debug: 3,
    });

    let localStream;
    let room;
    peer.on('open', () => {
        // Get things started
        step1();
    });
    peer.on("connection", (conn) => {
        const el = $('.remoteVideos').find('video').get(0);
        el.play();
        console.log("reconnection");
    });
    peer.on('error', err => {
        //alert(err.message);
        // Return to step 2 if error occurs
        step2();
    });

    $('.call').on('click', () => {
        var ticket_count = $("#ticket_count").val();
        var user_type = $("#user_type").val();
        if(user_type == 0)
        {
            if(parseInt(ticket_count) == 0){
                alert("チケットを購入してください。");
                return;
            }
        }
        // Initiate a call!
        const roomName = $('#join-room').val();
        if (!roomName) {
            return;
        }
        room = peer.joinRoom('mesh_video_' + roomName, {stream: localStream});

        $('#room-id').text(roomName);
        step3(room);
    });

    $('#endBtn').on('click', () => {
        console.log("click");
        start_flag = false;
        room.close();
        step2();
    });

    $('#stopBtn').on('click', () => {
        var videoEl = document.getElementById('my-video');
        // now get the steam
        stream = videoEl.srcObject;
        // now get all tracks
        tracks = stream.getTracks();
        // now close each track by having forEach loop
        tracks.forEach(function(track) {
            // stopping every track
            track.stop();
        });
        stop_flag = true;
    });

    $('#playBtn').on('click', () => {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            $(".my_stop_screen").css("display", "none");
            $("#my-video").css("display", "initial");
                //use WebCam
                navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
                this.localStream = stream;
                var videoEl = document.getElementById('my-video');
                videoEl.srcObject = stream;
                videoEl.play();
            });
            stop_flag = false;
            startTimer();
        }
    });

    // Retry if getUserMedia fails
    $('#step1-retry').on('click', () => {
        $('#step1-error').hide();
        step1();
    });

    //stop, play  event
    $(".remoteVideos, #my-video").on('pause',function(){
        console.log("stop");
        stop_flag = true;
    });
    $(".remoteVideos, #my-video").on('play',function(){
        console.log("play");
        stop_flag = false;
        startTimer();
    });
    // set up audio and video input selectors
    const audioSelect = $('#audioSource');
    const videoSelect = $('#videoSource');
    const selectors = [audioSelect, videoSelect];

    navigator.mediaDevices.enumerateDevices()
        .then(deviceInfos => {
            const values = selectors.map(select => select.val() || '');
            selectors.forEach(select => {
                const children = select.children(':first');
                while (children.length) {
                    select.remove(children);
                }
            });

            for (let i = 0; i !== deviceInfos.length; ++i) {
                const deviceInfo = deviceInfos[i];
                const option = $('<option>').val(deviceInfo.deviceId);

                if (deviceInfo.kind === 'audioinput') {
                    option.text(deviceInfo.label ||
                    'Microphone ' + (audioSelect.children().length + 1));
                    audioSelect.append(option);
                } else if (deviceInfo.kind === 'videoinput') {
                    option.text(deviceInfo.label ||
                    'Camera ' + (videoSelect.children().length + 1));
                    videoSelect.append(option);
                }
            }

            selectors.forEach((select, selectorIndex) => {
                if (Array.prototype.slice.call(select.children()).some(n => {
                    return n.value === values[selectorIndex];
                    })) {
                    select.val(values[selectorIndex]);
                }
            });

            videoSelect.on('change', step1);
            audioSelect.on('change', step1);
        });

    function step1() {
      // Get audio/video stream
        const audioSource = $('#audioSource').val();
        const videoSource = $('#videoSource').val();
        const constraints = {
            audio: {deviceId: audioSource ? {exact: audioSource} : undefined},
            video: {deviceId: videoSource ? {exact: videoSource} : undefined},
        };
        navigator.mediaDevices.getUserMedia(constraints).then(stream => {

            $('#my-video').get(0).srcObject = stream;
            localStream = stream;

            if (room) {
                room.replaceStream(stream);
                return;
            }

            step2();
        }).catch(err => {
            $('#step1-error').show();
            console.error(err);
        });
    }

    function step2() {
        $(".my_stop_screen").css("display","none");
        $("#my-video").css("display", "initial");
        $(".other_stop_screen").css("display","flex");
        $('#their-videos').empty();
        $('#step1').hide();
        $('#join-room').focus();
    }

    function step3(room) {
      // Wait for stream on the call, then set peer video display
        room.on('stream', stream => {
            $(".other_stop_screen").css("display","none");
            const peerId = stream.peerId;
            const id = 'video_' + peerId + '_' + stream.id.replace('{', '').replace('}', '');

            $('#their-videos').append($(
                '<div class="video_' + peerId +'" id="' + id + '">' +
                    '<video class="remoteVideos" autoplay playsinline>' +
                '</div>'));
            $('#video-id').val(id);
            const el = $('#' + id).find('video').get(0);
            el.srcObject = stream;
            el.play();
            var user_type = $("#user_type").val();
            start_flag = true;
            stop_flag = false;
            startTimer();
            console.log("startTimer");
            console.log("sdfsdsdfsd");
        });

        room.on('removeStream', function(stream) {
            const peerId = stream.peerId;
            $('#video_' + peerId + '_' + stream.id.replace('{', '').replace('}', '')).remove();
            console.log("removeStream");
        });

        room.on('stopStream', function(stream) {
            stream.getTracks().forEach(function(track) {
                if (track.readyState == 'live') {
                    track.stop();
                }
            });
            console.log("stopStream");
        });
        // UI stuff
        room.on('close', step2);
        room.on('peerLeave', peerId => {
            start_flag = false;
            $('.video_' + peerId).remove();
            console.log("leave");
        });
        $('#step1').hide();
    }
});
