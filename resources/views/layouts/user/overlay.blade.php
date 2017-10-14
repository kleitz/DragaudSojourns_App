<!-- Overlay -->
<div id="dark-overlay" class="dark-overlay-gen fix-fill flex-row-center hidden">
  <!-- EMAIL / PASSWORD UPDATE POPUP -->
  <div id="confidential-modal" class="confidential-modal hidden">
    <confidential-modal v-if="newConfidential == true" @close="confidentialClose"></confidential-modal>
  </div>

  <!-- NEW BOOKING POPUP -->
  <div id="new-booking-modal" class="new-booking-modal hidden">
    <new-booking-modal v-if="newBooking == true" @close="bookingClose"></new-booking-modal>
  </div>

  <!-- MAKE PAYMENT POPUP -->
  <div id="new-payment-modal" class="new-payment-modal hidden">
    <new-payment-modal v-if="newPayment == true" @close="paymentClose"></new-payment-modal>
  </div>

</div>
