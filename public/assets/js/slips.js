$("#barCode").barcode(
    $("#barCode").attr("custom-id"),
    "code128",
    {
        showHRI: true,
        barWidth: 3,
    }
);

window.print()
window.addEventListener('afterprint', () => {
    window.close();
});