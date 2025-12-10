<script>
function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(sec => {
        sec.classList.remove('active-section');
    });
    document.getElementById(sectionId).classList.add('active-section');
}
</script>

</body>

</html>