var longestCommonSubstring = function (strs) {
    if (strs.length === 0) return "";

    function isCommonSubstring(sub) {
        return strs.every(str => str.toLowerCase().includes(sub.toLowerCase()));
    }

    let longest = "";

    for (let length = 2; length <= strs[0].length; length++) {
        for (let start = 0; start <= strs[0].length - length; start++) {
            let substring = strs[0].slice(start, start + length);
            if (isCommonSubstring(substring)) {
                if (substring.length > longest.length) {
                    longest = substring;
                }
            }
        }
    }
    return longest;
};

console.log(longestCommonSubstring(["цветок", "поток", "хлопок"]));
console.log(longestCommonSubstring(["собака", "гоночная маашина", "машина"]));