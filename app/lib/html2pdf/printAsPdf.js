function printAsPDF() {
    
    const element = document.getElementById('ticketContainer');

    if (!element) {
        console.error('Element not found');
        return;
    }

    const options = {
        margin: 10,
        filename: 'ticket.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf(element, options).from(element).outputPdf();
}