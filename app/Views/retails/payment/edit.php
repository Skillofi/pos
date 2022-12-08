<div class="modal-header">
    <h5 class="modal-title">Add Payment</h5>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
</div>

<div class="modal-body">
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <input type="hidden" class="id" id="id" name="id" value="<?= $payment['id'] ?>" />

    <div class="fv-row mb-8">
        <input type="date" placeholder="Date" id="datetime" name="datetime" autocomplete="off" class="form-control bg-transparent" required value="<?= date('Y-m-d', strtotime($payment['datetime'])) ?>" />
        <span class="text-danger datetime-error"></span>
    </div>

    <div class="fv-row mb-8">
        <input type="number" placeholder="Amount" id="amount" name="amount" autocomplete="off" class="form-control bg-transparent" required value="<?= $payment['amount'] ?>" />
        <span class="text-danger amount-error"></span>
    </div>
    <div class="fv-row mb-8">
        <select class="form-control payment_method" name="payment_method" id="payment_method" required>
            <option <?= ($payment['payment_method'] == "Cash") ? "selected" : "" ?> value="Cash">Cash</option>
            <option <?= ($payment['payment_method'] == "Gift Card") ? "selected" : "" ?> value="Gift Card">Gift Card</option>
            <option <?= ($payment['payment_method'] == "Credit Card") ? "selected" : "" ?> value="Credit Card">Credit Card</option>
            <option <?= ($payment['payment_method'] == "Cheque") ? "selected" : "" ?> value="Cheque">Cheque</option>
            <option <?= ($payment['payment_method'] == "Other") ? "selected" : "" ?> value="Other">Other</option>
            <option <?= ($payment['payment_method'] == "Deposite") ? "selected" : "" ?> value="Deposite">Deposite</option>
        </select>
        <span class="text-danger payment_method-error"></span>
    </div>
    <div class="fv-row mb-8">
        <textarea class="form-control payment_note" id="payment_note" name="payment_note" placeholder="Payment Note..." rows="3"><?= $payment['payment_note'] ?></textarea>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save">Save changes</button>
</div>

<script>
    $(".save").on("click", () => {
        let id = $("#id").val()
        let datetime = $("#datetime").val()
        let amount = $("#amount").val()
        let payment_method = $("#payment_method").val()
        let payment_note = $("#payment_note").val()
        let errorFlag = 0;
        if (datetime == "") {
            errorFlag = 1;
            $(".datetime-error").html('field required');
        } else {
            $(".datetime-error").html('');
        }
        if (amount == "") {
            errorFlag = 1;
            $(".amount-error").html('field required');
        } else {
            $(".amount-error").html('');
        }
        if (payment_method == "") {
            errorFlag = 1;
            $(".payment_method-error").html('field required');
        } else {
            $(".payment_method-error").html('');
        }
        if (errorFlag == 1) {
            return false;
        }
        Payment.updatePayment({
            'id': id,
            'datetime': datetime,
            'amount': amount,
            'payment_method': payment_method,
            'payment_note': payment_note,
        })
    })
</script>