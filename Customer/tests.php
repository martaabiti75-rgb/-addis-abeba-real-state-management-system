  <div class="wallet-dropdown">
          <div class="wallet-selected" id="walletDisplayOwner">
              <img src="" id="walletIconOwner" class="wallet-icon">
              <span id="walletTextOwner">Select Wallet / Bank</span>
          </div>
         <?php
                $dataQBn = $CommonOBJ->getBindAccount($_SESSION['sessionID']);

                if ($dataQBn) {
                ?>

                <div class="wallet-options" id="walletOptionsOwner">

                <?php
                    foreach ($dataQBn as $values) {

                        $bank = strtolower($values['bank_name']);
                        $logo = "";

                        if ($bank === "mpessa") $logo = "../files/bnlogos/mpessa.png";
                        if ($bank === "awash")  $logo = "../files/bnlogos/awash.jfif";
                        if ($bank === "dashen") $logo = "../files/bnlogos/dashen.png";
                        if ($bank === "cbe")    $logo = "../files/bnlogos/cbe1.jfif";
                        if ($bank === "tellbirr")  $logo = "../files/bnlogos/telebirr.png";
                        if ($bank === "wegagen")  $logo = "../files/bnlogos/wegagen.png";
                        if ($bank === "nib")  $logo = "../files/bnlogos/nib.jpg";
                ?>
                    
                    <div class="wallet-item-owner"
                         data-value="<?= htmlspecialchars($values['bank_name']); ?>"
                         data-img="<?= $logo; ?>">

                        <img src="<?= $logo; ?>" style="height:30px; width: 60px; margin-right:8px;">
                        <?= htmlspecialchars($values['bank_name']); ?>

                    </div>

                <?php
                    } // end foreach
                ?>
                </div>

                <?php
                } // end if
                ?>
                <input type="hidden" name="walletSelectOwner" id="walletInpuOwner">
          <input type="hidden" name="walletSelectOwner" id="walletSelectOwner">
      </div>


<script>
document.getElementById("walletDisplayOwner").onclick = function () {
    document.getElementById("walletOptionsOwner").style.display =
        document.getElementById("walletOptionsOwner").style.display === "block"
            ? "none"
            : "block";
};

document.querySelectorAll(".wallet-item-owner").forEach(item => {
    item.onclick = function () {
        let img = this.getAttribute("data-img");
        let text = this.innerText;
        let value = this.getAttribute("data-value");

        document.getElementById("walletIconOwner").src = img;
        document.getElementById("walletIconOwner").style.display = "inline-block";
        document.getElementById("walletTextOwner").innerText = text;

        document.getElementById("walletInpuOwner").value = value;
        document.getElementById("walletOptionsOwner").style.display = "none";
    };
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll(".wallet-item-owner");
    const input = document.getElementById("walletSelectOwner");

    items.forEach(item => {
        item.addEventListener("click", function () {

            // remove previous selected
            items.forEach(i => i.classList.remove("active-wallet"));

            // set new selected
            this.classList.add("active-wallet");

            // store value to hidden input
            input.value = this.getAttribute("data-value");
        });
    });

});
</script>
