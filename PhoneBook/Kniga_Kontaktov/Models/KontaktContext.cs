using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Web;

namespace Kniga_Kontaktov.Models
{
    public class KontaktContext : DbContext
    {
        public KontaktContext() : base("DefaultConnection")
        { }
        public DbSet<Kontakt> Kontakts { get; set; }
        public DbSet<KontaktRole> KontaktRoles { get; set; }
    }
}