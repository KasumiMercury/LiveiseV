require("./bootstrap");

import topPage from "./pages/TopPage.vue";

import { createApp } from "vue";

const app = createApp({
    components: {
        topPage,
    },
});

app.mount("#app");
