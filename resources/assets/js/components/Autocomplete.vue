<template>
 <div>
  <input type="text" placeholder="Enter Contact name" v-model="query" v-on:keyup="autoComplete" class="form-control">
  <div class="panel-footer" v-if="results.length && hide == false">
   <ul class="list-group">
    <li class="list-group-item" v-for="result in results" v-on:click="replaceInput(result.name)">
     {{ result.name }}
    </li>
   </ul>
  </div>
 </div>
</template>
<script>
 export default{
  data(){
   return {
    query: '',
    results: [],
    hide: false
   }
  },
  methods: {
   replaceInput(result){
    this.query = result;
    this.hide = true;
   },
   autoComplete(){
    this.results = [];
    if(this.query.length > 1){
      this.hide = false;
      axios.get('/search',{params: {query: this.query}}).then(response => {
      this.results = response.data;
     });
    }
   }
  }
 }
</script>