<div id="goverlay" class="dark-overlay-gen fix-fill hidden" style="overflow-y: hidden">
  <!-- include icon picker -->
  <icon-select ref="iconselect" @close="hideIconSelect" @location="updateIconLoc" @name="updateIconName"></icon-select>
</div>
<div :class="{'gpanel-expand z-depth-2' : groupEdit == true, 'panel panel-secure border-panel-light gpanel' : true}">
  <div class="panel-heading">
    <div class="flex-row-between">
      <h5 style="margin: 7px 0; font-weight: 300">Group @{{ groupIn.number }}</h5>
      @if ($systemLevel)
      <a href="javascript:;" class="gfocus-button ds-button button-cancel" v-if="groupEdit == false" @click="emitEdit">Edit</a>
      <a href="javascript:;" class="gfocus-button ds-button gc-delete" v-if="groupEdit == true" @click="cancelEdit">Cancel</a>
      @endif
    </div>
  </div>
  <div class="panel-body gfocus-body">
    <div v-if="groupEdit == false">
      @include('partials.admin.group.before')
    </div>
    <div v-if="groupEdit == true">
      @include('partials.admin.group.after')
    </div>
  </div>
</div>
