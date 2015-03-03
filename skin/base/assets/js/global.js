jQuery.extend(jQuery.validator.messages, {
    required: "Inputan ini harus diisi.",
    remote: "Tolong benahi field ini.",
    email: "Format email tidak valid.",
    url: "Format URL tidak valid.",
    date: "Format tanggal tidak valid .",
    dateISO: "Inputkan tanggal (ISO) tidak valid.",
    number: "Inputan numerik tidak valid.",
    digits: "Inputan harus berupa digit angka.",
    creditcard: "Nomor kartu kredit tidak valid.",
    equalTo: "Silakan masukkan inputan yang sama lagi.",
    accept: "Silakan masukkan inputan dengan ekstensi yang valid .",
    maxlength: jQuery.validator.format("Panjang maksimal {0} karakter."),
    minlength: jQuery.validator.format("Panjang minimal {0} karakter."),
    rangelength: jQuery.validator.format("Panjang karakter harus antara {0} dan {1} karakter."),
    range: jQuery.validator.format("Masukkan inputan antara {0} dan {1}."),
    max: jQuery.validator.format("Inputan harus kurang dari atau sama dengan {0}."),
    min: jQuery.validator.format("Inputan harus lebih dari atau sama dengan {0}.")
});