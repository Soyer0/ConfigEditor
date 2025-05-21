document.querySelectorAll('.open-modal-btn').forEach(button => {
    button.addEventListener('click', () => {
        const configKey = button.getAttribute('data-config');
        const config = configData[configKey];

        document.getElementById('configModalLabel').textContent = configKey.replace(/_/g, ' ').toUpperCase();

        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = '';

        for (const key in config) {
            const value = config[key];
            const inputId = `input_${configKey}_${key}`.replace(/\s+/g, '_').replace(/[^\w\-]/g, '');

            if (Array.isArray(value)) {
                modalBody.innerHTML += `
            <div class="mb-3">
                <label class="form-label" for="${inputId}">${key}</label>
                <input type="text" class="form-control" id="${inputId}" data-key="${key}" value="${value[0] ?? ''}">
            </div>
        `;
            } else {
                modalBody.innerHTML += `
            <div class="mb-3">
                <label class="form-label" for="${inputId}">${key}</label>
                <input type="text" class="form-control" id="${inputId}" data-key="${key}" value="${value}">
            </div>
        `;
            }
        }


        const configModalEl = document.getElementById('configModal');
        const configModal = new bootstrap.Modal(configModalEl);
        configModal.show();

        const saveBtn = document.getElementById('saveConfigBtn');
        saveBtn.onclick = () => {
            const inputs = modalBody.querySelectorAll('input.form-control');
            const updatedConfig = {};

            inputs.forEach(input => {
                const key = input.getAttribute('data-key');
                const val = input.value;

                if (Array.isArray(config[key])) {
                    updatedConfig[key] = [val];
                } else {
                    updatedConfig[key] = val;
                }
            });


            ajax('saveConfig', {
                configKey: configKey,
                configData: updatedConfig
            }, function(response) {
                configData[configKey] = updatedConfig;
                configModal.hide();
            }, function(error) {
                console.error('Failed to save config:', error);
            });
        };
    });
});
