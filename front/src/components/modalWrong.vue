<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Ответ неверный
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="text-black">
                          {{ help }}
                        </p>
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
import { RouterLink, RouterView } from 'vue-router';
export default {
    props:{
        modalWrongTrue:{
            type:Boolean,
        },
        help:{
            type:String,
        },
    },
    methods:{
        CloseModal(){
            this.$emit("closeHelp", false);
        }
    }
}
</script>
