<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80vh; height:60vh; margin-left:-25%">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Ответ неверный
                        </h5>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <p v-if="help_type == 'Текст'" class="text-black" style="font-size: 24px;">
                          {{ help }}
                        </p>
                        <img style="width: 100%; object-fit:contain;" v-if="help_type == 'Изображение'" :src="link + help_file">
                        <audio controls v-if="help_type == 'Аудио'" class="w-75">
                            <source :src="link + help_file" type="audio/mp3">
                        </audio>
                        <video style="width: 100%; display: block; object-fit:cover; border-radius:15px;" controls v-if="help_type == 'Видео'" :src="link + help_file">
                            <source :src="link + help_file" type="video/mp4">
                        </video>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary w-50 h-100" @click="CloseModal" data-bs-dismiss="modal">Продолжить</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</template>
<script>
import { link } from '@/main';
import { RouterLink, RouterView } from 'vue-router';
export default {
    props:{
        modalWrongTrue:{
            type:Boolean,
        },
        help:{
            type:String,
        },
        help_file:{
            type:String,
        },
        help_type:{
            type:String,
        },
    },
    data(){
        return{
            link:'',
        }
    },
    methods:{
        CloseModal(){
            this.$emit("closeHelpWrong", false);
        }
    },
    mounted(){
        this.link = link;
    }
}
</script>
