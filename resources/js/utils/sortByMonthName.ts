export const sortByMonthName = (a: string, b: string) => {
    const months = [
        "january",
        "february",
        "march",
        "april",
        "may",
        "june",
        "july",
        "august",
        "september",
        "october",
        "november",
        "december",
    ];

    a = a.toLowerCase();
    b = b.toLowerCase();

    if (months.indexOf(a) === -1 || months.indexOf(b) === -1) {
        throw new Error("Invalid month name");
    }

    return months.indexOf(a) - months.indexOf(b);
};
