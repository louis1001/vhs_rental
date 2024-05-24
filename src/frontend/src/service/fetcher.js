export class Fetcher {
  constructor() {
    this.baseUrl = process.env.VUE_APP_API_BASE_URL;
  }

  /**
   * Fetch data from the API
   * @param url
   * @param {headers: {}} options - fetch options
   * @returns {Promise<any>}
   */
  async fetch(url, options = {}) {
    const response = await fetch(`${this.baseUrl}${url}`, options);

    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(
        `Failed to fetch ${url}: ${response.status} ${response.statusText} - ${errorText}`
      );
    }

    // Return JSON response
    return await response.json();
  }
}

const fetcher = new Fetcher();

export default fetcher;
