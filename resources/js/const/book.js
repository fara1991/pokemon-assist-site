export default {
    typeIv: 'iv',
    typeEv: 'ev',
    typeLevel: 'level',
    ivStatusName(value) {
        if (value === 0) {
            return 'ダメかも';
        } else if (1 <= value && value <= 15) {
            return 'まあまあ';
        } else if (16 <= value && value <= 25) {
            return 'かなりいい';
        } else if (26 <= value && value <= 29) {
            return 'すごくいい';
        } else if (value === 30) {
            return 'すばらしい';
        } else if (value === 31) {
            return 'さいこう(きたえた!)';
        } else {
            return 'undefined';
        }
    },
    validateNumber(value, type) {
        let minValue = 0;
        let maxValue = 0;
        if (type === this.typeIv) {
            minValue = 0;
            maxValue = 31;
        } else if (type === this.typeEv) {
            minValue = 0;
            maxValue = 252;
        } else if (type === this.typeLevel) {
            minValue = 1;
            maxValue = 100;
        }

        if (value < minValue) {
            value = minValue;
        } else if (value > maxValue) {
            value = maxValue;
        }
        return value;
    },
}
