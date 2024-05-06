<template>
<modal :v-bind:modalTrue="modalTrue" v-if="modalTrue == true"/>
<modalWrong :v-bind:modalWrongTrue="modalWrongTrue" v-on:closeHelp="closeHelp" :help="help" :help_file="help_file" :help_type="help_type" v-if="modalWrongTrue == true"/>
<modalRight :v-bind:modalRightTrue="modalRightTrue" v-on:closeHelp="closeHelp" :answer="answer" :answer_type="answer_type" :answer_file="answer_file" v-if="modalRightTrue == true"/>

<div style="height:100vh; background: url(https://abrakadabra.fun/uploads/posts/2022-02/1644770314_44-abrakadabra-fun-p-fon-dlya-viktorini-62.jpg) no-repeat center center fixed;  background-size: cover;  -webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover;">
    <div class="block col-12 h-100">
        <div class="col-12 h-50 d-flex align-items-center justify-content-center">
            <div class="col-10 gap-1 h-75 p-2 d-flex align-items-center justify-content-center rounded text-white" style="box-shadow: 12px 11px 40px 26px rgba(34, 60, 80, 0.58); background-color:#2e404582; overflow-y:auto">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <img v-if="showQue.file != null" style="width:15rem; height: 15rem; object-fit:contain;" :src="link + showQue.file">
                </div>
                <div class="col-7 d-flex align-items-center justify-content-center">
                    <h3 v-if="showQue.text != null" class=" text-wrap text-justify" style="font-size: 24px;">{{ showQue.text }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 h-50 d-flex gap-5 flex-row flex-wrap align-items-center justify-content-center p-5" style="margin-top:-2%">
            <div class="col-5 h-50 d-flex flex-row" v-for="ans in showAnsw">
                <button @click="CheckRight(ans)" :id="`Button_${ans.id}`" class="btn col-12 border rounded text-white" style="box-shadow: 12px 11px 40px 14px rgba(34, 60, 80, 0.5); background-color:#2e404582; font-size:20px;">
                    <p v-if="ans.answer_text" style="font-weight: 700;">{{ ans.answer_text }}</p>
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
import modalRight from '@/components/modalRight.vue'
export default {
    components:{
        modal, modalWrong, modalRight
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
            help_file:'',
            help_type:'',

            modalRightTrue:false,
            answer:'',
            answer_file:'',
            answer_type:'',
        }
    },
    methods:{
        getQue(id){
            axios.get(`${link}/api/question/${id}`).then(res=>{
                this.questions = res.data;
                this.showQue = this.questions[this.countAnsQue];
                console.log(this.questions);
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

                this.modalRightTrue = true;
                this.answer = ans.explain;
                this.answer_file = ans.explain_file;
                this.answer_type = ans.explain_type;
                this.animateBlokc(ans);
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
                this.help_file = ans.help_file;
                this.help_type = ans.help_type;
            }
        },
        closeHelp(){
            this.modalWrongTrue = false;
            this.modalRightTrue = false;
        },
        animateBlokc(ans){
            let block =  document.querySelector('.block');
            let btn = document.getElementById('Button_'+ans.id);
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
        }
    },
    mounted(){
        this.getQue(this.$route.params.id);
        this.getAnsw(this.$route.params.id)
        this.link = link;
    },
}
</script>
