import puppeteer from 'puppeteer-extra';
import StealthPlugin from 'puppeteer-extra-plugin-stealth';

// add stealth plugin and use defaults (all evasion techniques)
puppeteer.use(StealthPlugin());

const browser = await puppeteer.launch({
    headless: false,
    userDataDir: "/Users/jack/Library/Application Support/Google/Chrome/Profile 2",
    executablePath: "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome",
    args: [
    '--disable-blink-features=AutomationControlled'
    ]
});

const page = await browser.newPage();
// Set screen size.
await page.setViewport({width: 1080, height: 1024});
await page.goto('https://www.nytimes.com/crosswords');
await page.waitForNavigation();

// Log in if necessary

if (logInElem) {
    const logInButton = page.locator(xPathSelector);
    logInButton.click();
    page.waitFor(5000);
    // await page.waitForSelector('')
    // await page.type('#email', 'jack.lawrence103@gmail.com', {delay: 100});
    // await page.locator('div ::-p-text(Continue)').click();
    // await page
    // .locator('button')
    // .filter(button => button.textContent === 'Continue')
    // .click();
    // await page.waitForSelector('#password');
    // await page.type('#password', 'Milkman18,');
};

// const streak_count = '::-p-xpath(/html/body/div[3]/div[1]/div[1]/div[2]/div[4]/article/a/div[4]/div[1])'
// Waits for current streak element to load
// await page.waitForSelector(streak_count, {visible: true});

// const text = await page.$eval(streak_count, el => el.textContent.trim());

// console.log(text);


// Capture a screenshot for verification
await page.screenshot({ path: './NYT_landing_page.png' });

// Close the browser
// await browser.close();