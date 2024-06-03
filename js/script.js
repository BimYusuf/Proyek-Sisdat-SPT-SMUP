$("#form-jalur").show()
$("#form-fakultas").hide()
$("#form-prodi").hide()

function showJalur(){
    $("#form-jalur").show()
    $("#form-fakultas").hide()
    $("#form-prodi").hide()

    $("#tambah-data-container h1").html("Tambah Jalur")

    $("#data-selector button:nth-child(1)").addClass("select-active")
    $("#data-selector button:nth-child(2)").removeClass("select-active")
    $("#data-selector button:nth-child(3)").removeClass("select-active")
}

function showFakultas(){
    $("#form-jalur").hide()
    $("#form-fakultas").show()
    $("#form-prodi").hide()

    $("#tambah-data-container h1").html("Tambah Fakultas")

    $("#data-selector button:nth-child(1)").removeClass("select-active")
    $("#data-selector button:nth-child(2)").addClass("select-active")
    $("#data-selector button:nth-child(3)").removeClass("select-active")
}

function showProdi(){
    $("#form-jalur").hide()
    $("#form-fakultas").hide()
    $("#form-prodi").show()

    $("#tambah-data-container h1").html("Tambah Prodi")

    $("#data-selector button:nth-child(1)").removeClass("select-active")
    $("#data-selector button:nth-child(2)").removeClass("select-active")
    $("#data-selector button:nth-child(3)").addClass("select-active")
}

$("#filter-container").hide()
$("#pendaftar-container").hide()
$("#detail-container").hide()

function showDataUniv(){
    $(".grid-place").css("grid-template-columns", "40% 1fr")

    $("#asesor-tab button:nth-child(1)").addClass("tab-active")
    $("#asesor-tab button:nth-child(2)").removeClass("tab-active")

    $("#data-fakultas-container").show()
    $("#prodi-container").show()
    $("#table-jalur-container").show()
    $("#tambah-data-container").show()

    $("#filter-container").hide()
    $("#pendaftar-container").hide()
    $("#detail-container").hide()
}

function showDataPendaftar(){
    $(".grid-place").css("grid-template-columns", "1fr 40%")

    $("#asesor-tab button:nth-child(1)").removeClass("tab-active")
    $("#asesor-tab button:nth-child(2)").addClass("tab-active")

    $("#data-fakultas-container").hide()
    $("#prodi-container").hide()
    $("#table-jalur-container").hide()
    $("#tambah-data-container").hide()

    $("#filter-container").show()
    $("#pendaftar-container").show()
    $("#detail-container").show()
}