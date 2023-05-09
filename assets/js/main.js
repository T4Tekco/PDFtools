const colorInputs = document.querySelectorAll('.color_qr');
const foreColorInput = document.querySelector('input[name="foreColor"]');

colorInputs.forEach(colorInput => {
	
  colorInput.addEventListener('click', event => {
	//  colorInput.style.border = '2px solid green';
	colorInputs.forEach(input => {
		if (input === colorInput) {
		  input.style.border = '2px solid green';
		} else {
		  input.style.border = 'none';
		}
	  });
    const selectedColor = event.target.value;
    foreColorInput.value = selectedColor;
	// selectedColor.style.border = '2px solid green';
  });

});
