<script>
const user = 'lurnis';
const repo = 'lurnis.github.io';
const path = 'files/audios';

const apiUrl = `https://api.github.com/repos/${user}/${repo}/contents/${path}`;

fetch(apiUrl, {
  headers: {
    'User-Agent': 'Mozilla/5.0'
  }
})
.then(response => response.json())
.then(data => {
  const audioExtensions = ['mp3', 'wav', 'ogg', 'm4a'];
  const audios = data
    .filter(file => {
      const ext = file.name.split('.').pop().toLowerCase();
      return audioExtensions.includes(ext);
    })
    .map(file => ({
      name: file.name,
      url: file.download_url
    }));

  console.log(JSON.stringify(audios, null, 2));
})
.catch(error => console.error('Xatolik:', error));
</script>
