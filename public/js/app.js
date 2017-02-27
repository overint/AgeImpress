var app = new Vue({
  el: '#app',
  data: {
    hasResult: false,
    name: '',
    dob: '',
    current: {},
    history: []

  },
  methods: {
    checkDOB: function () {
      if (this.name == '')
      {
          swal("Error!", "You must enter your name!", "error");
          return;
      }
      this.$http.post('api/calculate', {name: this.name, dob: $('#dob').val()}).then(response => {
        if (response.body.success){
          this.current = response.body;
          this.hasResult = true;
          this.getHistory();
        }else{
          swal("Error!", response.body.error, "error");
        }
      });

    },
      getHistory : function() {
          this.$http.get('api/history').then(response => {
              this.history = response.body;
      });
      },
  },
  mounted : function() {
      this.getHistory();
      $('#dob').datepicker({
          format: "yyyy-mm-dd",
          orientation: "bottom auto"
      });
  },
});

