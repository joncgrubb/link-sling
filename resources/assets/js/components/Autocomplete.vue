<template>
 <div>
  <input type="text" placeholder="Enter Contact name" v-model="query" v-on:keyup="autoComplete" class="form-control">
  <div class="panel-footer" v-if="results.length">
   <ul class="list-group">
    <li class="list-group-item" v-for="result in results">
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
    results: []
   }
  },
  methods: {
   autoComplete(){
    this.results = [];
    if(this.query.length > 1){
      axios.get('/search',{params: {query: this.query}}).then(response => {
      console.log(response.status);
      console.log('Query string: ' + this.query);
      this.results = response.data;
      console.log(this.results);
      console.log(typeof(this.results));
     });
    }
   }
  }
 }
</script>