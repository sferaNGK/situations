<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Ответ Верный
                        </h5>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <p v-if="answer_type == 'Текст'" class="text-black">
                          {{ answer }}
                        </p>
                        <img style="width: auto; max-height: 100%; object-fit:contain;" v-if="answer_type == 'Изображение'" :src="link + answer_file">
                        <audio controls v-if="answer_type == 'Аудио'" class="w-75">
                            <source :src="link + answer_file" type="audio/mp3">
                        </audio>
                        <video style="width: 100%; max-height: 100%; display: block; object-fit:cover; border-radius:15px;" controls v-if="answer_type == 'Видео'" :src="link + answer_file">
                            <source :src="link + answer_file" type="video/mp4">
                        </video>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary w-50 h-50" @click="CloseModal" data-bs-dismiss="modal">Продолжить</button>
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
        modalRightTrue:{
            type:Boolean,
        },
        answer:{
            type:String,
        },
        answer_file:{
            type:String,
        },
        answer_type:{
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
            this.$emit("closeHelp", false);
        }
    },
    mounted(){
        this.link = link;
    }
}
</script>
