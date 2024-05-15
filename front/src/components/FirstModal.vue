<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80vh; height:60vh; margin-left:-25%">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Добро пожаловать в игру: "{{game.title}}"
                        </h5>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <p class="text-black" style="font-size: 24px;">
                          {{ game.description }}
                        </p>
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
        game:{
            type:Object,
        },
    },
    data(){
        return{
            link:'',
        }
    },
    methods:{
        CloseModal(){
            this.$emit("closeFirst", false);
        }
    },
    mounted(){
        this.link = link;
    }
}
</script>
