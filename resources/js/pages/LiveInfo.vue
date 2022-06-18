<template>
    <div>
        <!-- header -->
        <div class="bg-stone-800 py-3">
            <header>
                <div
                    class="flex justify-evenly items-end max-w-5xl mx-auto bg-stone-800 pt-4 pb-2"
                >
                    <div class="font-Caveat text-2xl sm:text-6xl">
                        <h2 class="emitRed">Live</h2>
                    </div>
                    <div class="font-Caveat text-4xl sm:text-8xl">
                        <h2 class="emitTitle">iseV</h2>
                    </div>
                    <div class="font-Caveat text-2xl sm:text-6xl">
                        <h2 class="emitRed">Info</h2>
                    </div>
                </div>
            </header>
        </div>
        <div class="w-full m-0 h-px goldLine"></div>
        <p
            class="text-md w-fit ml-auto mr-5 my-2 text-green-300"
            :class="load === true ? 'visible' : 'invisible'"
        >
            Update
        </p>
        <div class="container mx-auto py-5 px-2">
            <p class="text-3xl text-gray-200 text-center my-4">Now Live</p>
            <div class="flex flex-row flex-wrap">
                <div
                    v-for="item in Live"
                    :key="'live' + item.id"
                    class="py-1 px-1 sm:px-2 lg:px-1 w-full sm:w-1/2 lg:w-1/3 mx-auto"
                >
                    <Card
                        :title="item.title"
                        :VideoID="item.VideoID"
                        :date="null"
                        :col="item.ImageCol"
                        :member="item.display"
                    ></Card>
                </div>
            </div>
            <p class="text-3xl text-gray-200 text-center mt-6 mb-4">
                Live Schedule
            </p>
            <div class="flex flex-row flex-wrap">
                <div
                    v-for="item in Schedule"
                    :key="'schedule' + item.id"
                    class="py-1 px-1 sm:px-2 lg:px-1 w-full sm:w-1/2 lg:w-1/3 mx-auto"
                >
                    <Card
                        :title="item.title"
                        :VideoID="item.VideoID"
                        :date="item.schedule"
                        :col="item.ImageCol"
                        :member="item.display"
                    ></Card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Card from "../components/Card.vue";
export default {
    data() {
        return {
            Live: [],
            Schedule: [],
            Interval: undefined,
            load: false,
        };
    },
    mounted() {
        this.getStatus();
        this.Interval = setInterval(this.getStatus, 600000);
    },
    methods: {
        getStatus() {
            let self = this;
            this.load = true;
            axios
                .get("/api/status")
                .then((response) => {
                    self.Live = response["data"]["live"];
                    self.Schedule = response["data"]["schedule"];
                    self.load = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    unmounted: function () {
        clearTimeout(this.Interval);
    },
    components: {
        Card,
    },
};
</script>
<style scoped>
.emitTitle {
    color: #f59e0b;
    text-shadow: 0px 0px 20px #f59e0b;
}
.emitRed {
    color: #c4302b;
    text-shadow: 0px 0px 10px #d8c6c5;
}
.emitWhite {
    color: #dfc9c8;
    text-shadow: 0px 0px 20px #dfc9c8;
}
.goldLine {
    background: linear-gradient(
        45deg,
        #662f09 0%,
        #e49d2e 45%,
        #f2da97 70%,
        #e7c177 85%,
        #94591e 90% 100%
    );
    background: -moz-linear-gradient(
        45deg,
        #662f09 0%,
        #e49d2e 45%,
        #f2da97 70%,
        #e7c177 85%,
        #94591e 90% 100%
    );
    background: -webkit-linear-gradient(
        45deg,
        #662f09 0%,
        #e49d2e 45%,
        #f2da97 70%,
        #e7c177 85%,
        #94591e 90% 100%
    );
}
</style>
