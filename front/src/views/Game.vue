<template>
<FirstModal :game="game" v-if="modalFirst == true" v-on:closeFirst="closeFirst"/>
<modal :v-bind:modalTrue="modalTrue" v-if="modalTrue == true"/>
<modalWrong :v-bind:modalWrongTrue="modalWrongTrue" v-on:closeHelpWrong="closeHelpWrong" :help="help" :help_file="help_file" :help_type="help_type" v-if="modalWrongTrue == true"/>
<modalRight :v-bind:modalRightTrue="modalRightTrue" v-on:closeHelp="closeHelp" :answer="answer" :answer_type="answer_type" :answer_file="answer_file" v-if="modalRightTrue == true"/>

<div style="height:100vh;">
    <img class="col-12 h-100" src="/src/assets/images/back.jpeg" style="z-index: -10; position:absolute;">

    <!-- Преподователи -->
    <div class="block col-12 h-100 d-flex flex-column align-items-around justify-content-evenly" v-if="gameType == 'Преподователи'">
        <div class="col-12 d-flex align-items-center justify-content-center position-relative" style="height: 65%;">
            <div class="col-12 h-100 p-2 flex-row d-flex align-items-center rounded text-white">
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <img v-if="showQue.file != null" style="width:45rem; max-height: 40rem; object-fit:contain;" :src="link + showQue.file">
                </div>
                <div class="col-6 d-flex h-100 flex-column align-items-center gap-3 text-center justify-content-around">
                    <div>
                        <img src="../assets/images/logoTeach.png" style="width:45%">
                    </div>
                    <div class="col-11 d-flex align-items-center text-center justify-content-center p-4" style="background-color:white; color:black; border-radius:5rem; height:45vh;">
                        <!-- <h3 v-if="showQue.text != null" class=" text-wrap text-center" style="font-size: 20px; font-weight:700;">{{ showQue.text }}</h3> -->
                        <textarea readonly v-if="showQue.text != null" class="form-control d-flex align-items-center justify-content-center text-center w-100 h-75" style="font-size: 20px; font-weight:800; border:none;white-space: break-spaces;">{{ showQue.text }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex flex-row flex-wrap align-items-center justify-content-center" style="background-color: white; height:35%; border-radius:100px 100px 0 0">
            <div class="col-6 h-50 d-flex align-items-center justify-content-center flex-row" v-for="(ans, key) in showAnsw">
                <button @click="CheckRight(ans)" :id="`Button_${ans.id}`" class="btn check text-center rounded w-75" style="background-color:#80f3c3;box-shadow: 0px 5px 13px 3px rgba(34, 60, 80, 0.25); height:10vh; overflow-y:auto">
                    <p style="font-weight: 800; font-size:18px;">{{ ans.answer_text }}</p>
                </button>
            </div>
        </div>
    </div>

    <!-- Программисты -->
    <div class="block col-12 h-100 d-flex flex-column align-items-around justify-content-evenly" v-if="gameType == 'Программисты'">
        <div class="col-12 d-flex align-items-center justify-content-center position-relative" style="height: 50%;">
            <div class="col-12 poistion-relation p-2 flex-row d-flex align-items-center justify-content-around rounded text-white">
                <div class="position-absolute" style="left: 5rem; top: 2rem;">
                    <img src="../assets/images/logoProg.png" style="width:45%">
                </div>
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <img v-if="showQue.file != null" style="width:80rem; height: 27rem; object-fit:contain;" :src="link + showQue.file">
                </div>
            </div>
        </div>

        <div class="col-12 d-flex flex-row flex-wrap align-items-center justify-content-center" style="background-color: white; height:50%; border-radius:100px 100px 0 0">
            <div class="col-11 d-flex flex-column align-items-ceneter gap-3 text-center justify-content-around">
                <textarea readonly v-if="showQue.text != null" class="form-control d-flex align-items-center justify-content-center text-center w-100 h-100" style="font-size: 25px; font-weight:800; border:none;white-space: break-spaces;">{{ showQue.text }}</textarea>
                <!-- <div class="col-12 d-flex align-items-center text-center justify-content-center p-4" style="background-color:black; color:black; border-radius:5rem; height:10vh;">
                    <h3 v-if="showQue.text != null" class=" text-wrap text-center" style="font-size: 20px; font-weight:700;">{{ showQue.text }}</h3>
                </div> -->
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center flex-row" v-for="(ans, key) in showAnsw" style="margin-top: -5%;">
                <button @click="CheckRight(ans)" :id="`Button_${ans.id}`" class="btn check text-center rounded w-75" style="background-color:#80f3c3;box-shadow: 0px 5px 13px 3px rgba(34, 60, 80, 0.25); height:10vh; overflow-y:auto">
                    <p style="font-weight: 800; font-size:22px;">{{ ans.answer_text }}</p>
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
import FirstModal from '@/components/FirstModal.vue'
export default {
    components:{
        modal, modalWrong, modalRight, FirstModal
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
            gameType:'',

            game:[],
            modalFirst:true,
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
        getGames(){
            axios.get(`${link}/api/games`).then(res => {
                this.games = res.data;
                this.games.forEach(element => {
                    if(this.$route.params.id == element.id){
                        this.gameType = element.type;
                        this.game = element;
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
                let btn1 = document.querySelectorAll('.check');
                btn1.forEach(element => {
                    console.log(element);
                    element.style.disabled = true;
                });
            } else if(ans.right == this.RightAnswer && this.length + 1 == this.questions.length){
                this.length += 1;
                let btn = document.getElementById('Button_'+ans.id);
                btn.classList.add('right');
                let btn1 = document.querySelectorAll('.check');
                btn1.forEach(element => {
                    console.log(element);
                    element.style.disabled = true;
                });
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
            let btn1 = document.querySelectorAll('.check');
                btn1.forEach(element => {
                    console.log(element);
                    element.style.disabled = true;
                });
            this.animateBlokc(this.anse, this.modalRightTrue);
        },
        closeHelpWrong(){
            this.modalWrongTrue = false;
        },
        closeFirst(){
            this.modalFirst = false;
        },
        animateBlokc(ans, modal){

            let block =  document.querySelector('.block');
            let btn = document.getElementById('Button_'+ans.id);
            setTimeout(() => {
                block.classList.add('hide');
                btn.classList.remove('right');
            }, 200);
            setTimeout(() => {
                block.classList.add('apear');
                this.showQue = this.questions[this.countAnsQue];
                this.showAnsw = this.answers[this.countAnsQue];
            }, 400);
                block.classList.remove('hide');
                block.classList.remove('apear');


        }
    },
    mounted(){
        this.getQue(this.$route.params.id);
        this.getAnsw(this.$route.params.id)
        this.link = link;
        this.getGames();
    },
}
</script>

