using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Kniga_Kontaktov.Startup))]
namespace Kniga_Kontaktov
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
