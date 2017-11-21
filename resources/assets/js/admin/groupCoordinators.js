const groupCoordinatorsApp = new Vue({
    el: '#group-coordinators-app',
    data: {
      admin: adminLoaded,
      group: groupLoaded,
      coordinators: coordinatorsLoaded,
      removeIndex: { created: '', id: '', user: {
          name: '', id: '', email: ''
      }},
      coordinator: {
        new: { name: '', email: '', cell: '', home: '', street: '', zip: '', active: 0, available: null },
        existing: { selected: '-1', name: '', id: '', searched: false, active: 1},
        valid: null,
      },
      typingTimeout: null,
      searchUser: '',
      selectUser: '',
    },
    methods: {
      newCoordinator(){
        fadeIn('#coverlay');
        fadeIn('#new-coordinator-modal');
      },
      removeCoordinator(index){
        this.removeIndex = this.coordinators[index];
        fadeIn('#coverlay');
        fadeIn('#remove-coordinator-modal');
      },
      deleteSelected(){
        let coordApp = this;
        $.ajax({
          type: "POST",
          url: '/coordinators/destroy',
          data: { coord_id: coordApp.removeIndex.id  },
          success: function(response) {
            if (response == 'SUCCESS') {
              window.location.reload();
            }
          }
        });
      },
      updateSelected() {
        if (this.coordinator.existing.selected != '-1'){
          this.coordinator.existing.name = this.selectUser[this.coordinator.existing.selected].name;
          this.coordinator.existing.id = this.selectUser[this.coordinator.existing.selected].id;
          this.checkExisting();
        } else {
          this.coordinator.valid = null;
        }
      },
      storeMethod(event){
        this.coordinator.valid = null;
        if (event.toElement.id == 'radio-new-user'){
          this.coordinator.new.active = 1;
          this.coordinator.existing.active = 0;
          this.validateNewUser();
          setTimeout(function(){
            bindFormatters();
          }, 100);
        } else {
          this.coordinator.existing.active = 1;
          this.coordinator.new.active = 0;
          this.updateSelected();
        }

      },
      searchExisting(){
        this.coordinator.existing = { selected: '-1', name: '', id: '', searched: true, active: 1 };
        this.coordinator.valid = null;
        let coordApp = this;
        $.ajax({
          type: "GET",
          url: '/user/search/criteria-name',
          data: { name: coordApp.searchUser },
          success: function(response) {
            coordApp.selectUser = response;
          }
        });
      },
      searchAuto(event){
        if (event.keyCode == 13) {
          this.coordinator.valid = null;
          this.searchExisting();
        }
      },
      checkExisting(){
        let coordApp = this;
        $.ajax({
          type: "GET",
          url: '/coordinators/precheck',
          data: { user_id: coordApp.coordinator.existing.id, group_id: coordApp.group.id },
          success: function(response) {
            if (response == 'OPEN')
              coordApp.coordinator.valid = true;
            if (response == 'TAKEN')
              coordApp.coordinator.valid = false;
          }
        });
      },
      checkNewUser(){
        let coordApp = this;
        this.coordinator.valid = false;
        clearTimeout(coordApp.typingTimeout);
        coordApp.typingTimeout = setTimeout(function(){
          $.ajax({
            type: "GET",
            url: '/precheck',
            data: { email: coordApp.coordinator.new.email},
            success: function(response) {
              if (response == 'OPEN')
                coordApp.coordinator.new.available = true;
              if (response == 'TAKEN')
                coordApp.coordinator.new.available = false;

              coordApp.validateNewUser();
            }
          });
        }, 200);
      },
      validateNewUser(){
        let newUser = this.coordinator.new;
        if (validEmail(newUser.email) == true && newUser.name != '' && newUser.available == true &&
            (
              (newUser.home.length > 12 && newUser.cell == '') ||
              (newUser.home == '' && newUser.cell.length > 12) ||
              (newUser.home.length > 12 && newUser.cell.length > 12)
            ) 
            && newUser.street != '' && newUser.zip.length > 4)
        {
          this.coordinator.valid = true;
        } else {
          this.coordinator.valid = false;
        }
      },
      closeModals(){
        this.removeIndex = { created: '', id: '', user: {
            name: '', id: '', email: ''
        }};
        this.coordinator= {
          new: { name: '', email: '', cell: '', home: '', street: '', zip: '', active: this.coordinator.new.active, available: null },
          existing: { selected: '-1', name: '', id: '', searched: false, active: this.coordinator.existing.active},
          valid: null,
        };
        this.searchUser= '';
        this.selectUser= '';
        fadeOut('#coverlay');
        fadeOut('#remove-coordinator-modal');
        fadeOut('#new-coordinator-modal');
      }
    },
    mounted() {
    },
    components: {
      // all imported / created compenents
    },
    computed: {

    }
});
