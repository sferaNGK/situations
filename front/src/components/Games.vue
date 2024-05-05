<template>
<div class="container gap-5 d-flex align-items-center justify-content-center flex-row flex-wrap" style="height: 100vh; width:100%;" v-for="game in games">
    <div>
        <router-link :to="{path: '/game/'+game.id}">
            <button type="button" class="btn btn-primary" style="height: 120px; width:350px; font-size:25px;">{{ game.title }}</button>
        </router-link>
    </div>
</div>
</template>
<script>
import axios from 'axios'
  import { RouterLink, RouterView } from 'vue-router';
  export default {
    data() {
      return {
        games:[],
      };
    },
    methods: {
      getGames(){
        axios.get('http://127.0.0.1:8000/api/games').then(res => {
          this.games = res.data;
        });
      },
      GamePage(id){
        console.log(id);
      }
    },
    mounted() {
      this.getGames();
    },
  };
</script>
