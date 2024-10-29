<div class="d-inline" x-data="{
    number: {{ $amount }},
    formattedNumber() {
        return this.number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    },
    updateNumber(value) {
        this.number = value;
    }
}" 
x-init="updateNumber({{ $amount }})"
x-effect="updateNumber({{ $amount }})">
<span x-text="formattedNumber()"></span>
</div>
