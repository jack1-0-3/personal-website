import puppeteer from 'puppeteer-extra';
import StealthPlugin from 'puppeteer-extra-plugin-stealth';

// add stealth plugin and use defaults (all evasion techniques)
puppeteer.use(StealthPlugin());

(async () => {
    const browser = await puppeteer.launch({
        headless: false,
        userDataDir: "/Users/jack/Library/Application Support/Google/Chrome/Profile 2",
        executablePath: "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome",
        args: ['--disable-blink-features=AutomationControlled']
    });

    const page = await browser.newPage();
    await page.setViewport({ width: 1080, height: 1024 });

    await page.goto('https://www.nytimes.com/crosswords', { waitUntil: 'networkidle2' });

    // Robustly find a "Log in" link/button in the header and click it.
    // Avoid Playwright idioms; use Puppeteer ElementHandles and XPath/CSS.
        try {
            // Use an in-page evaluation to find and click the login link by text.
            const clicked = await page.evaluate(() => {
                const anchors = Array.from(document.querySelectorAll('header a, a'));
                for (let i = 0; i < anchors.length; i++) {
                    console.log(anchors[i]);
                }
                const re = /log\s?in|sign\s?in|signin/i;
                const anchor = anchors.find(a => a.textContent && re.test(a.textContent.trim()));
                if (!anchor) return false;
                anchor.click();
                return true;
            });
            if (clicked) {
                await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 10000 }).catch(() => {});
            } else {
                console.log('Login link not found via page.evaluate.');
            }
        } catch (err) {
            console.log('Error finding/clicking login link:', err && err.message ? err.message : err);
        }

    await page.screenshot({ path: './NYT_landing_page.png' });

    // await browser.close();
})();