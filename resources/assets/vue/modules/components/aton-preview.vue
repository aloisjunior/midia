<template>
    <v-layout
            row
            justify-center
    >
        <v-dialog v-model="openDialog"
                  persistent
                  width ="500px"
                  content-class="elevation-0"
                  @keyup.esc.prevent="setCancel()"
        >
            <material-card
                    title="Preview de Conteúdo"
                    :dark="isModeDarkForms"
                    :light="!isModeDarkForms"

                    :fullWidth="true"

                    @keyup.esc.prevent="setCancel()"
            >
                <template slot="option">
                    <v-tooltip left
                               content-class="left">
                        <v-btn
                                icon
                                class="ma-0"
                                color="red"
                                slot="activator"
                                small
                                @click.prevent.stop="setCancel()"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <span>Fechar preview</span>
                    </v-tooltip>
                </template>

                <template slot="extra">
                    <v-responsive :aspect-ratio="16/9">
                            <v-card-text class="pa-1">
                                <v-fade-transition mode="out-in">
                                <v-card flat v-if="isVideo" max-width="500px" class="ma-1">
                                    <video ref="videoRef" id="videoRef" :src="url" controls width="100%" autoplay v-model="video">

                                        Vídeo não suportado
                                    </video>
                                </v-card>

                                <v-img :aspect-ratio="16/9" v-else-if="isImage" :src="url" class="ma-1">
                                </v-img>

                                <iframe v-else-if="isUrl" :src="linkPreview" frameborder="0"></iframe>
                                </v-fade-transition>
                            </v-card-text>
                    </v-responsive>
                </template>
            </material-card>

        </v-dialog>
    </v-layout>

</template>

<script>
    import AtonBaseForm from '../components/aton-base-form.vue';

    export default {
        mixins: [
            // AtonCssLoader,
            AtonBaseForm,
        ],
        props: {
            openDialog: {
                default: false,
                type: Boolean,
            },
            mime: {
                default: '',
                type: String
            },
            linkPreview: {
                default: '',
                type: String,
            },
        },
        name: 'aton-preview',
        data() {
            return {


                url: '',

                video: false,

            }
        },
        methods: {
            setCancel: function () {
                if (this.isVideo){
                    this.$refs.videoRef.pause();
                }
                this.url = '';
                this.$emit('setCancel', false);
            },
        },

        watch: {
            openDialog: function (val) {
                if (!val) {
                    this.url = '';
                } else {
                    this.url = this.linkPreview;
                }
            },

            video: function (val) {
                if (val){
                    this.$nextTick(function () {
                        if (this.$refs.videoRef){
                            this.$refs.videoRef.play();
                        }
                    });
                }
            },
        },
        computed: {
            isVideo: function () {
                this.video = (this.mime == 'video/mp4') && (this.url != '');
                return this.video;
            },
            isImage: function () {
                return this.mime == 'image/png' || this.mime == 'image/jpg' || this.mime == 'image/jpeg';
            },
            isUrl: function () {
                return this.mime == '';
            }
        },
    }
</script>

<style scoped="">

</style>