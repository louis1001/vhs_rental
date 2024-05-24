import fetcher from "@/service/fetcher";

export class TopicosService {
  async getTopicos() {
    return fetcher.fetch("/topicos");
  }
}

export class ClientsService {
  async getClients() {
    return fetcher.fetch("/clients");
  }

  async getClient(id) {
    return fetcher.fetch(`/clients/${id}`);
  }

  async createClient(contents) {
    return fetcher.fetch(`/clients`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contents),
    });
  }

  async updateClient(id, contents) {
    return fetcher.fetch(`/clients/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contents),
    });
  }

  async deleteClient(id) {
    return fetcher.fetch(`/clients/${id}`, {
      method: "DELETE",
    });
  }
}

export class MoviesService {
  async getMovies() {
    return fetcher.fetch("/movies");
  }

  async getMovie(id) {
    return fetcher.fetch(`/movies/${id}`);
  }

  async createMovie(contents) {
    return fetcher.fetch(`/movies`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contents),
    });
  }

  async updateMovie(id, contents) {
    return fetcher.fetch(`/movies/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contents),
    });
  }

  async deleteMovie(id) {
    return fetcher.fetch(`/movies/${id}`, {
      method: "DELETE",
    });
  }
}

class RentsService {
  async saveRent(rent) {
    return fetcher.fetch(`/rents`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(rent),
    });
  }
}

export const topicos = new TopicosService();
export const clients = new ClientsService();
export const movies = new MoviesService();
export const rents = new RentsService();
