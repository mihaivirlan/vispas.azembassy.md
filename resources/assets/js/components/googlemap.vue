<template>
    <gmap-map
            :center="center"
            :zoom="zoom"
            style="width: 100%;"
            :draggable="false"
            ref="main"
            :options="{'scrollwheel':false}"
    >
        <gmap-marker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                :clickable="true"
                :draggable="false"
                @click="center=m.position"
                :icon="markerImage"
        ></gmap-marker>
    </gmap-map>
</template>

<script>
    import * as VueGoogleMaps from 'vue2-google-maps';
    import Vue from 'vue';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyCwGS5FBngA2v3ycmB7bfWIdVE9xB_P3MQ',
            //v: 'VERSION NUMBER',
            // libraries: 'places',
        }
    });

    export default {
        data () {
            return {

            }
        },
        props:['center','markers','markerImage','zoom'],
        methods:{

        }
    }
</script>
