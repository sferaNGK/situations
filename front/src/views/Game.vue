<template>
<modal :v-bind:modalTrue="modalTrue" v-if="modalTrue == true"/>
<modalWrong :v-bind:modalWrongTrue="modalWrongTrue" v-on:closeHelp="closeHelp" :help="help" v-if="modalWrongTrue == true"/>

<div style="height:100vh; background: url(https://abrakadabra.fun/uploads/posts/2022-02/1644770314_44-abrakadabra-fun-p-fon-dlya-viktorini-62.jpg) no-repeat center center fixed;  background-size: cover;  -webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover;">
    <div class="block col-12 h-100">
        <div class="col-12 h-50 d-flex align-items-center justify-content-center">
            <div class="col-10 h-50 d-flex align-items-center justify-content-center rounded text-white" style="box-shadow: 12px 11px 40px 26px rgba(34, 60, 80, 0.58); background-color:#2e404582; overflow-y:auto">
                <h3 v-if="showQue.text != null" class="fs-1 text-wrap text-center">{{ showQue.text }}</h3>
                <img v-if="showQue.file != null && showQue.type == 'Картинка'" :src="link + showQue.file" alt="">
            </div>
        </div>

        <div class="col-12 h-50 d-flex gap-5 flex-row flex-wrap align-items-center justify-content-center p-5" style="margin-top:-2%">
            <div class="col-5 h-50 d-flex flex-row" v-for="ans in showAnsw">
                <button @click="CheckRight(ans)" :id="`Button_${ans.id}`" class="btn col-12 border rounded text-white fs-2" style="box-shadow: 12px 11px 40px 14px rgba(34, 60, 80, 0.5); background-color:#2e404582">
                    <p v-if="ans.answer_text">{{ ans.answer_text }}</p>
                    <!-- <div v-if="ans.answer_type == 'Изображение'" :style="`background: url(${link + ans.answer_file}) no-repeat center center fixed;background-size: cover;  -webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover; height:100%`"></div> -->
                    <img style="width: auto; max-height: 100%; object-fit:contain; border-radius:15px;" v-if="ans.answer_type == 'Изображение'" :src="link + ans.answer_file">
                    <audio controls v-if="ans.answer_type == 'Аудио'" class="w-75">
                        <source :src="link + ans.answer_file" type="audio/mp3">
                    </audio>
                    <video style="width: 100%; max-height: 100%; display: block; object-fit:cover; border-radius:15px;" controls v-if="ans.answer_type == 'Видео'" :src="link + ans.answer_file">
                        <source :src="link + ans.answer_file" type="video/mp4">
                    </video>
                </button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
import {link} from '@/main'
import modal from '@/components/modal.vue'
import modalWrong from '@/components/modalWrong.vue'
export default {
    components:{
        modal, modalWrong,
    },
    data(){
        return{
            questions:[],
            answers:[],

            showQue:[],
            showAnsw:[],

            link:'',

            RightAnswer:'',

            countAnsQue:0,
            length:0,

            modalTrue:false,
            modalWrongTrue:false,
            help:'',
        }
    },
    methods:{
        getQue(id){
            axios.get(`${link}/api/question/${id}`).then(res=>{
                this.questions = res.data;
                this.showQue = this.questions[this.countAnsQue];
            });
        },
        getAnsw(id){
            axios.get(`${link}/api/answer/${id}`).then(res=>{
                this.answers = res.data;
                this.showAnsw = this.answers[this.countAnsQue];
                this.showAnsw.forEach(element => {
                    if(element.right == 1){
                        this.RightAnswer = element.right;
                    }
                });
            });
        },
        CheckRight(ans){
            let block =  document.querySelector('.block');
            if(ans.right == this.RightAnswer && this.length < this.questions.length && this.length + 1 < this.questions.length){
                this.countAnsQue += 1;
                this.length += 1;
                let btn = document.getElementById('Button_'+ans.id);

                btn.classList.add('right');
                setTimeout(() => {
                    block.classList.add('hide');
                    btn.classList.remove('right');
                }, 500);
                setTimeout(() => {
                    block.classList.add('apear');
                    this.showQue = this.questions[this.countAnsQue];
                    this.showAnsw = this.answers[this.countAnsQue];
                }, 800);
                block.classList.remove('hide');
                block.classList.remove('apear');

            } else if(ans.right == this.RightAnswer && this.length + 1 == this.questions.length){
                this.length += 1;
                let btn = document.getElementById('Button_'+ans.id);
                btn.classList.add('right');

                setTimeout(() => {
                    this.modalTrue = true;
                }, 500);

            }
            else{
                this.modalWrongTrue = true;
                this.help = ans.help;
            }
        },
        closeHelp(){
            this.modalWrongTrue = false;
        }
    },
    mounted(){
        this.getQue(this.$route.params.id);
        this.getAnsw(this.$route.params.id)
        this.link = link;
    },
}
</script>
