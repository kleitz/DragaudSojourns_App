<template id="success-modal-template">
  <div :id="id" class="overlay-rounded-wrapper flex-col-center overlay-near-shadow hidden">
    <div class="flex-row-reverse">
      <a :id="id +'-close'" class="modal-ds-close overlay-wide-close pointer"  @click="$emit('close')">X</a>
    </div>
    <div class="overlay-content-wide overlay-success flex-col-center text-center">
      <div class="success-check-wrapper flex-row-center">
        <div class="success-check-bubble">
        </div>
        <div class="checkmark">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 viewBox="0 0 161.2 161.2" enable-background="new 0 0 161.2 161.2" xml:space="preserve">
            <path class="check-path" fill="none" stroke="#fff" stroke-miterlimit="10" d="M425.9,52.1L425.9,52.1c-2.2-2.6-6-2.6-8.3-0.1l-42.7,46.2l-14.3-16.4
            	c-2.3-2.7-6.2-2.7-8.6-0.1c-1.9,2.1-2,5.6-0.1,7.7l17.6,20.3c0.2,0.3,0.4,0.6,0.6,0.9c1.8,2,4.4,2.5,6.6,1.4c0.7-0.3,1.4-0.8,2-1.5
            	c0.3-0.3,0.5-0.6,0.7-0.9l46.3-50.1C427.7,57.5,427.7,54.2,425.9,52.1z"/>
            <polyline class="check-path" fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="113,52.8
            	74.1,108.4 48.2,86.4 "/>
          </svg>
        </div>
        </div>
        <h3 class="overlay-wide-header"><slot name="header"></slot></h3>
        <p class="overlay-wide-msg"><slot name="message"></slot></p>
        <p class="overlay-subscript" v-if="sub == true"><slot name="subscript"></slot></p>
        <p class="overlay-subscript-xs" v-if="subxs == true"><slot name="subscript-xs"></slot></p>
        <a :href="'/profile/' + href" :id="id + '-button'" class="modal-ds-button success-button">{{ button }}</a>
    </div>
  </div>
</template>

<script>

export default {
  template: "success-modal-template",
  props: ['id', 'button', 'sub', 'subxs', 'href'],
  data() {
    return {

    }
  },
  methods: {

  }
}

</script>
