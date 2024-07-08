const id='mxrefdlpjxylc7yqelk3'
const private_key='sk_722fee3e81054123a7394a2128bb75c7'
const public_key='pk_652e3b97a398409c97bbe4c8fd359743'

document.addEventListener('DOMContentLoaded', () => {
  OpenPay.setId(id)
  OpenPay.setApiKey(public_key)
  const deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName")
})
