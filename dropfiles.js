const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const fileListContainer = document.getElementById('file-list');

// Highlight drop zone on drag over
dropZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropZone.classList.add('hover');
});

// Remove highlight when drag leaves
dropZone.addEventListener('dragleave', () => {
  dropZone.classList.remove('hover');
});

// Handle file drop
dropZone.addEventListener('drop', (e) => {
  e.preventDefault();
  dropZone.classList.remove('hover');
  const files = e.dataTransfer.files;
  displayFiles(files);
});

// Handle click to open file selector
dropZone.addEventListener('click', () => {
  fileInput.click();
});

// Handle file selection
fileInput.addEventListener('change', () => {
  const files = fileInput.files;
  displayFiles(files);
});

// Display selected files
function displayFiles(files) {
  fileListContainer.innerHTML = '';
  for (let i = 0; i < files.length; i++) {
    const fileItem = document.createElement('div');
    fileItem.className = 'file-item';
    fileItem.textContent = files[i].name;
    fileListContainer.appendChild(fileItem);
  }
}