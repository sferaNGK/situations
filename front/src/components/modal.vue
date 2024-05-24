<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Поздравляем!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            Вы справились с заданием!!! 
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <router-link to="/" class="w-100 text-center">
                            <button class="btn btn-primary w-50 h-50">Вернуться на главную</button>
                        </router-link>
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
        modalTrue:{
            type:Boolean,
        },
    }
}
</script>

<style>
    .modal-dialog{
        width: 90%;

        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>