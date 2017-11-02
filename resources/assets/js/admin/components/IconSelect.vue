<template id="icon-select-template">
  <div id="icon-select" class="absolute group-icon-select hidden">
    <div class="z-depth-1 panel panel-secure ">
      <div class="panel-heading grey-panel flex-row-between">
        <h2 class="panel-title flex-col-center">Icon Select</h2>
        <span class="modal-ds-close pointer" @click="hideIconSelect">X</span>
      </div>
      <div class="panel-body">
        <div :class="{'icon-delete-container' : deleteMode == 1, 'panel-scroll relative' : true}" style="height: 250px">
          <div v-if="iconLoading == true" class="abs-fill flex-abs-center">
            <svg class="spinner spinner-dark" width="60px" height="60px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
              <circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
            </svg>
          </div>
          <div v-if="iconLoading == false" class="row flex-gen">
            <div v-for="icon, index in iconList" class='col-xs-4 flex-col'>
              <label class='group-icon full-height flex-col-end'>
                <div class='full-width relative'>
                  <div class='icon-overlay abs-fill'></div>
                  <img :src=" '/' + icon.loc" class='full-width'>
                </div>
                <div>
                  <input @click='selectIcon(index, $event)' type='radio' name='icon.jpg' :value='icon.loc'>{{ icon.name }}
                </div>
              </label>
            </div>
          </div>
        </div>
    <!-- UPLOAD NEW ICON -->
        <div style="margin-top: 20px" class="flex-row-between">
          <div class="input-group" style="width: 120px">
            <label class="input-group-btn">
                <span class="btn flex-col-center gc-button" style="margin-right: 0; ">
                    Upload new&hellip; <input accept="image/*"  @change="uploadNewIcon" type="file" style="display: none;" multiple/>
                </span>
            </label>
          </div>
          <button @click="deleteToggle" type="button" :class="{'gc-button gc-delete-active gc-delete' : deleteMode == 1, 'button-cancel gc-button button-white' : deleteMode == 0}" style="width: 120px;">{{ deleteMessage }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    template: "#icon-select-template",
  	props : [],
  	data() {
  		return {
          newIcon: '',
          iconLoading: true,
          deleteMode: 0,
          iconList: iconListLoaded,
  		}
  	},
    methods: {
      hideIconSelect(){
        this.$emit('close');
        this.deleteMode = 0;
      },
      selectIcon(index, event){
        // DELETE ICON OPTION
        if (this.deleteMode == 1){
          this.iconLoading = true;
          let fIcon = this.iconList[index].loc.split('/');
          fIcon = fIcon[fIcon.length-1];
          this.deleteIcon(fIcon, index);
        // SELECT ICON OPTION
        } else {
          let icon = event.target.value;
          let fIcon = icon.split('/');
          fIcon = fIcon[fIcon.length-1];
          let iExt = fIcon.indexOf('EXT');
          let iTime = fIcon.indexOf('TIME');
          let time = new Date(fIcon.slice(iTime + 4, iExt) * 1000);
          time = '-' + (time.getMonth() + 1) + '-' + time.getDate() + '-' + time.getFullYear();

          fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

          this.$emit('location', icon);
          this.$emit('name', fIcon);
          this.hideIconSelect();
        }
      },
      uploadNewIcon(event){
        let iconApp = this;
        this.iconLoading = true;

        event.preventDefault();
        let formData = new FormData;
        formData.append('file', event.target.files[0]);
        $.ajax({
              type: "POST",
              url: '/admin/icon/store',
              processData: false,
              contentType: false,
              cache: false,
              data: formData,
              dataType: 'JSON',
              statusCode: {
                200: function (response) {
                   let icon = response.responseText;
                   let fIcon = icon.split('/');
                   fIcon = fIcon[fIcon.length-1];
                   let iExt = fIcon.indexOf('EXT');
                   let iTime = fIcon.indexOf('TIME');
                   fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

                   iconApp.iconList.push({loc: icon, name: fIcon});
                   setTimeout(function(){
                     iconApp.iconLoading = false;
                     iconApp.deleteMode = 0;
                   },1000);
                },
             },
          });
      },
      deleteIcon(name, index){
        let iconApp = this;
        $.ajax({
              type: "POST",
              url: '/admin/icon/destroy',
              data: {icon: name},
              success: function(data){
                iconApp.deleteSuccess = true;
                iconApp.iconList.splice(index, 1);
                iconApp.$emit('location', '');
                iconApp.$emit('name', '');
                setTimeout(function(){
                  iconApp.iconLoading = false;
                },1000);
              }
          });
      },
      deleteToggle(){
        if (this.deleteMode == 1) {
          this.deleteMode = 0;
        } else {
          this.deleteMode = 1;
        }
      }
    },
    mounted() {
      for (let i = 0; i < this.iconList.length; i++){
          let fIcon = this.iconList[i].split('/');
          fIcon = fIcon[fIcon.length-1];
          let iExt = fIcon.indexOf('EXT');
          let iTime = fIcon.indexOf('TIME');
          fIcon = fIcon.slice(0, iTime) + fIcon.slice(iExt+3);

          this.iconList[i] = {loc: this.iconList[i], name: fIcon};
      }
    },
    computed: {
      // computed data
      deleteMessage(){
        if (this.deleteMode == 1)
          return "Cancel";
        if (this.deleteMode == 0)
          return "Delete icon";
      }
    }
  }
</script>

<style>

</style>
