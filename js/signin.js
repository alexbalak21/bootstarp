document.getElementById('formLogo').addEventListener('click', () => {
  document.getElementById('fileUpload').click()
})
document.getElementById('registerUser').addEventListener('submit', () => {
  let pass1 = document.getElementsByName('password1')[0].value
  let pass2 = document.getElementsByName('password2')[0].value
  if (pass1 !== pass2 || pass1 == '' || pass2 == '')
    document.getElementById('error').innerHTML = 'Les champs ne sont pas correctement remplis.'
  else document.getElementById('registerUser').submit()
})
