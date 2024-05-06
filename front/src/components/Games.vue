<template>
<div class="container gap-5 d-flex align-items-center justify-content-center align-content-center flex-row flex-wrap" style="height: 100vh; width:100%;">
    <div v-for="game in games">
        <router-link :to="{path: '/game/'+game.id}">
            <button type="button" class="btn btn-primary" style="height: 120px; width:350px; font-size:25px;">{{ game.title }}</button>
        </router-link>
    </div>
</div>
</template>
<script>
import { link } from '@/main';
import axios from 'axios'
  import { RouterLink, RouterView } from 'vue-router';
  export default {
    data() {
      return {
        games:[],
        link:'',
      };
    },
    methods: {
      getGames(){
        axios.get(`${link}/api/games`).then(res => {
          this.games = res.data;
        });
      },
      GamePage(id){
      }
    },
    mounted() {
        this.link = link;
      this.getGames();
    },
  };
</script>
