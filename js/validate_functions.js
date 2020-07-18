function validateForename(field) {
    return (field=="") ? "Не введено имя.\n" : ""
}
function validateSurname(field) {
    return (field=="") ? "Не введена фамилия.\n" : ""
}
function validateUsername(field) {
    if (field=="") return "Не введено имя пользователя.\n"
    else if (field.length<5) return "В имени пользователя должно быть не менее 5 символов.\n"
    else if (/\W/.test(field)) return "В имени пользователя разрешены только a-z, A-Z, 0-9, _ и -.\n"
    return ""
}
function validatePassword(field) {
    if (field=="") return "Не введен пароль.\n"
    else if (field.length<6) return "В пароле должно быть не менее 6 символов.\n"
    else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) return "Пароль должен содержать символы верхнего и нижнего регистра и цифры.\n"
    return ""
}
function validateAge(field) {
    if (field=="" || isNaN(field)) return "Не введен возраст.\n"
    else if (field<18 || field>110) return "Возраст должен быть от 18 до 110.\n"
    return ""
}
function validateEmail(field) {
    if (field=="") return "Не введен email.\n"
    else if (!((field.indexOf(".")>0) && (field.indexOf("@")>0)) || /[^\w.@]/.test(field)) return "Электронный адрес имеент неверный формат.\n"
    return ""
}