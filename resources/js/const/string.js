export default {
    hiraganaToKatakana(word) {
        return word.replace(/[\u3041-\u3096]/g, function(match) {
            let chr = match.charCodeAt(0) + 0x60;
            return String.fromCharCode(chr);
        });
    },
    katakanaToHiragana(word) {
        return word.replace(/[\u30a1-\u30f6]/g, function(match) {
            let chr = match.charCodeAt(0) - 0x60;
            return String.fromCharCode(chr);
        });
    }
}
