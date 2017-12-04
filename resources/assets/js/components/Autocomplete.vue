<template>
 <div>
  <input type="text" autocomplete="off" name="recipient" id="recipient" placeholder="Enter Contact name" v-model="query" v-on:keyup="autoComplete" class="form-control" required="true" oninvalid="this.setCustomValidity('Please enter a valid Contact')"
  oninput="setCustomValidity('')">
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
    if(this.query.length >= 1){
      this.hide = false;
      axios.get('/search',{params: {query: this.query}}).then(response => {
      this.results = response.data;
     });
    }
   }
  }
 }
</script>

<style scoped>
  li {
    cursor: pointer;
  }
  li:hover {
    background-color: #93C9FF;
    border-color: #4CA6FF;
    color: white;
  }
  .panel-footer {
    border-radius: 5px;
    box-shadow: 1px 1px 5px #ccc;
  }
</style>