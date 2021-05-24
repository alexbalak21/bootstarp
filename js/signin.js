document.getElementById('formLogo').addEventListener('click', () => {
  document.getElementById('fileUpload').click()
})
document.getElementById('registerUser').addEventListener('submit', () => {
  let pass1 = document.getElementsByName('password1')[0].value
  let pass2 = document.getElementsByName('password2')[0].value
  if (pass1 !== pass2) {
    document.getElementById('error').innerHTML = 'Les mots de pass ne corspontent pas.'
  } else document.getElementById('registerUser').submit()
})
