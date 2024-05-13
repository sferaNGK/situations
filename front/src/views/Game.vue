<template>
<modal :v-bind:modalTrue="modalTrue" v-if="modalTrue == true"/>
<modalWrong :v-bind:modalWrongTrue="modalWrongTrue" v-on:closeHelpWrong="closeHelpWrong" :help="help" :help_file="help_file" :help_type="help_type" v-if="modalWrongTrue == true"/>
<modalRight :v-bind:modalRightTrue="modalRightTrue" v-on:closeHelp="closeHelp" :answer="answer" :answer_type="answer_type" :answer_file="answer_file" v-if="modalRightTrue == true"/>

<div style="height:100vh;">
    <img class="col-12 h-100" src="/src/assets/images/Background.png" style="z-index: -10; position:absolute;">
    <div class="block col-12 h-100">
        <div class="col-12 d-flex align-items-center justify-content-center position-relative" style="height: 68%;">
            <div class="col-10 h-100 p-2 flex-column d-flex align-items-center rounded text-white">
                <div class="col-4 d-flex align-items-center justify-content-center" style="margin-top: 5%;">
                    <img v-if="showQue.file != null" style="width:65rem; height: 25rem; object-fit:contain;" :src="link + showQue.file">
                </div>
                <div class="col-7 d-flex align-items-end justify-content-center" style="height: 20%;">
                    <h3 v-if="showQue.text != null" class=" text-wrap text-center" style="font-size: 16px;">{{ showQue.text }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 h-25 d-flex flex-row flex-wrap align-items-center justify-content-center">
            <div class="col-6 h-50 d-flex align-items-center justify-content-center flex-row" v-for="(ans, key) in showAnsw">
                <button @click="CheckRight(ans)" v-if="key > 1" :id="`Button_${ans.id}`" class="btn rounded text-white" style="width:70%; height:80%; margin-top:10%">
                    <p v-if="ans.answer_text" style="font-weight: 700;">{{ ans.answer_text }}</p>
                </button>
                <button @click="CheckRight(ans)" v-else :id="`Button_${ans.id}`" class="btn rounde text-white" style="width:70%; height:80%; margin-top:3%">
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

            anse:[],
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
                this.anse = ans;
                // this.animateBlokc(ans);
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
            this.modalRightTrue = false;
            this.animateBlokc(this.anse, this.modalRightTrue);
        },
        closeHelpWrong(){
            this.modalWrongTrue = false;
        },
        animateBlokc(ans, modal){

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
