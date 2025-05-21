<div class="config-container">
    <div class="config-grid">
        <?php foreach ($configSections as $key => $section): ?>
            <div class="config-card">
                <span class="config-label"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $key))) ?></span>
                <button class="config-btn open-modal-btn" data-config="<?= htmlspecialchars($key) ?>">
                    Edit
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    const configData = <?= json_encode($configSections) ?>;
</script>