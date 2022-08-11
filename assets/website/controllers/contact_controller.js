import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['csrf'];

    async csrfTargetConnected() {
        const formName = this.csrfTarget.dataset.formName;
        const response = await fetch('/_form/token?form=' + formName + '&html=0', {
            credentials: 'same-origin', // required for old safari versions
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        this.csrfTarget.value = await response.text();
    }
}
