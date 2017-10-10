<!-- Overlay -->
<div id="dark-overlay" class="dark-overlay-gen fix-fill flex-abs-center hidden">
  <!-- Change email / password -->
  <div id="confidential-modal" class="confidential-modal hidden">
    <confidential-modal></confidential-modal>
  </div>
  <!-- Saving updates -->
  <loading-modal :id="'confidential-loader'">
    <template slot="header">Please wait...</template>
    <template slot="message">We're updating your information</template>
  </loading-modal>
  <!-- Update successful-->
  <success-modal :id="'confidential-success'" :button="'Continue'" :sub="false" :subxs="false">
    <template slot="header">Account updated!</template>
    <template slot="message">Close this box or press continue to proceed.</template>
  </success-modal>

</div>
