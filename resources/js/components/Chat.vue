<template>
    <div>
        <SkyWay></SkyWay>
    </div>
</template>

<script>
import SkyWay from "./SkyWayChat";
export default {
    components: {
        SkyWay
    },
    mounted() {
        console.log('chat')
    }
}
</script>
