require("./bootstrap");

import exampleComponent from "./components/ExampleComponent.vue";

import { createApp } from "vue";

const app = createApp({
    components: {
        exampleComponent,
    },
});

app.mount("#app");
