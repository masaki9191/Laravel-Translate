<template>
<div class="container">
    <div class="row" id="videochat">
        <!-- Video area -->
        <div class="col-md-8" id="video-container">
            <div class="other_stop_screen">
                <span>相手の顔</span>
            </div>
            <div id="their-videos" class="w-100"></div>
            <div class="button-group">
                <button class="btn default_button" id="callBtn">通話を始める</button>
                <button class="btn default_button" id="acceptBtn">通話を受ける</button>
                <button class="btn default_button" id="playBtn">通話を再開</button>
                <button class="btn default_button" id="stopBtn">一時停止</button>
                <button class="btn default_button" id="endBtn">通話を止める</button>
            </div>
            <div class="ec_content_sce_title margin-30 font-size-15" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;">
                ＊＜注意事項＞通話を止めるボタンを押しますと、1セッションと見なされます。<br>
                途中退席をしたい場合は、一時的ボタンを押し、通話を再開ボタンで会話を続けてください
            </div>
            <div class="d-none">
                <div class="select">
                    <label for="audioSource">Audio input source: </label><select id="audioSource"></select>
                </div>
                <div class="select">
                    <label for="videoSource">Video source: </label><select id="videoSource"></select>
                </div>
                <div id="step2">
                    <form id="make-call" class="pure-form d-none">
                        <input type="text" placeholder="Join room..." id="join-room">
                        <button class="pure-button pure-button-success" type="submit">Join</button>
                    </form>
                </div>
            </div>
            <div class="">
                <!-- Get local audio/video stream -->
                <div id="step1">
                    <div id="step1-error">
                        <p>ウェブカメラとマイクを確認してください。</p>
                        <a href="#" class="btn default_button" id="step1-retry">再試行</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Steps -->
        <div class="col-md-4">
            <div class="my_stop_screen">
                <span>自分の顔</span>
            </div>
            <video id="my-video" class="w-100" muted="true" autoplay playsinline></video>
            <div class="ec_content_sce_title margin-30 font-size-20">
                <div class="margin-20 position-center">
                    <img id="avatar_img" src="" style="border-radius:50%; width:200px; height=200px;" alt="">
                </div>
                <div class="margin-20 text-center">
                    <span>名前</span>
                    <span id="search_name"></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('SkyWayChat')
        }
    }
</script>
