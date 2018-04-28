# Weather
Provides weather data for use in index templates.

**Cache is updated every hour**

## Installation
Upload `inc` to the root of your MyBB installation.

## Usage
| Variable                           | Description         | Example |
|------------------------------------|---------------------|---------|
| `{$weather['weather'][0]['main']}` | Current weather     | Sunny   |
| `{$weather['main']['temp']}`       | Current temperature | 73.5    |

See [OpenWeatherMap API Documentation](https://openweathermap.org/api) for further information.